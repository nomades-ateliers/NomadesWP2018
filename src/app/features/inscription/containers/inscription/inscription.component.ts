import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { Router } from '@angular/router';
import { FormBuilder, FormGroup, FormArray, Validators } from '@angular/forms';
import { WpApiService } from '@app/shared/services';
import { Observable } from 'rxjs';
import { map, tap } from 'rxjs/operators';
import { loadFile } from '@app/utils';
import { LoadingController, AlertController } from '@ionic/angular';

declare const grecaptcha: any;
@Component({
  selector: 'app-inscription',
  templateUrl: './inscription.component.html',
  styleUrls: ['./inscription.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class InscriptionComponent implements OnInit {

  currentUrl: any;
  baseUrl = 'https://nomades.ch/wp-content/uploads/2018/10/nomade02-.png';
  form: FormGroup;
  wksList: any[];
  totalEcolage = 0;
  data$: Observable<any>;
  loader: HTMLIonLoadingElement;

  constructor(
    private _router: Router,
    private readonly _formBuilder: FormBuilder,
    private _wpApi: WpApiService,
    private _http: WpApiService,
    private _alertCtrl: AlertController,
    private _loadingCtrl: LoadingController

  ) { }

  ngOnInit() {
    this.currentUrl = this._router.url;
    // load JS file
    loadFile(this);
    this._buildForm();
    this.data$ = this._wpApi.getData({path: 'pages', slug: `slug=inscription`}).pipe(
      map(res => (res.length === 1 ) ? res[0] : res),
      tap(data => (!data.type) ? window.location.href = '404' : null)
    );
  }

  ionViewWillLeave() {
    this._buildForm();
    console.log('form:', this.form.value.workshops);
  }

  ionViewWillEnter() {
    // extract data from localstorage
    const workshops = JSON.parse(localStorage.getItem('nomades_workshop') || '[]');
    // build form control with correct object data
    // + calculate total amount
    workshops.map(c => {
      this.totalEcolage = this.totalEcolage + (+c.ecolage_wk);
      return this.getControl().push(this._formBuilder.control(c));
    });
    // patch value to the form
    this.form.patchValue({workshops});
    console.log('form', this.form.value);
  }

  private _buildForm() {
    this.form = this._formBuilder.group({
      nom: ['', Validators.compose([Validators.required, Validators.minLength(2)])],
      prenom: ['', Validators.compose([Validators.required, Validators.minLength(2)])],
      naissance: ['', Validators.compose([Validators.minLength(2)])],
      profession: [''],
      email: ['', Validators.compose([Validators.required, Validators.email])],
      adresse: [''],
      message_pre_inscription: [''],
      cp: [''],
      total_workshop: [],
      workshops: this._formBuilder.array(
        [],
        Validators.compose([
          Validators.required,
          Validators.minLength(1)
        ])
      ),
      ajax: ['true'],
      captcha: [''],
    });
    // to prevent multiple sending action
    this.form.markAsPristine();
  }

  getControl(): FormArray {
    // return trainingForm.vat.value
    return this.form.get('workshops') as FormArray;
  }

  removeItem(index: number) {
    // remove from form
    this.getControl().markAsDirty();
    this.getControl().removeAt(index);
    // calcule new total
    this.totalEcolage = 0;
    this.form.value.workshops.map(i => {
      this.totalEcolage = this.totalEcolage + (+i.ecolage_wk);
      return i;
    });
    // remove from localstorage
    localStorage.setItem('nomades_workshop', JSON.stringify(this.form.value.workshops));
    // update object data
    this.wksList = JSON.parse(localStorage.getItem('nomades_workshop') || '[]');
  }

  async submit() {
    console.log(this.form.valid, this.form.value);
    if (!this.form.valid) {
      console.log('invalid form data');
      return;
    }
    // to prevent multiple sending action
    this.loader = await this._loadingCtrl.create({
      message: 'envois du formulaire en cours...',
    })
    this.loader.present();
    // to prevent multiple sending action
    this.form.markAsPristine();
    // validation recaptcha
    grecaptcha.execute();
  }

  async onSubmit(e) {
    console.log('submit callback reCAPTCHA', e);
    if (!e) return;
    this.form.patchValue({captcha: e})
    this.form.patchValue({total_workshop: this.totalEcolage})
    // to prevent multiple sending action
    this.form.markAsPristine();
    await this._sendDataForm();
    // rebuild form with initial data
    this._buildForm();
  }


  private _sendDataForm() {
    // if(grecaptcha) grecaptcha.execute();
    console.log('send', this.form.value);
    return this._http.sendInscription(this.form.value)
    .then((res: any) => this._displayNotif(res))
    .then((res: any) => (res.result === 200) ? (this._buildForm(), res) : res)
    // display user notification error
    .catch(err => this._displayNotif({result: 500}));
  }


  async _displayNotif(res) {
    const { result = null} = res;
    if (!result) return;
    if (this.loader) this.loader.dismiss();
    let alertElement: HTMLIonAlertElement
    switch(true) {
      case result === 200:
        // clear localstorage
        await localStorage.removeItem('nomades_workshop');
        alertElement = await this._alertCtrl.create({
          subHeader: `Merci pour votre pré-inscription!`,
          message: 'Nous reviendrons vers vous rapidement.',
          buttons: [{
            text: 'ok'
          }]
        })
        break;
      default: 
        alertElement = await this._alertCtrl.create({
          subHeader: `Erreur`,
          message: `Il y a eu un problème lors de l'envoi de votre message.`,
          buttons: [{
            text: 'ok'
          }]
        })
    }
    await alertElement.present()
    return res
  }

  goWk() {
    this._router.navigate(['./workshops']);
  }
}
