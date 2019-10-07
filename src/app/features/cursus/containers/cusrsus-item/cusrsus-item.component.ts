import { Component, OnInit, ViewEncapsulation, ElementRef, ViewChild, OnDestroy } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

import { Observable, Subscription } from 'rxjs';
import { map, tap } from 'rxjs/operators';

import { WpApiService } from '@app/shared/services';
import { fadeAnim } from '@app/shared/animations/fade.animation';
import { FormGroup, FormBuilder, Validators, FormArray, FormControl } from '@angular/forms';
import { AlertController, LoadingController } from '@ionic/angular';
// import { loadFile } from '@app/utils';
// import { ReCaptchaV3Service, OnExecuteData } from 'ng-recaptcha';
import { environment } from '@env/environment';
// import { loadFile } from '@app/utils';

declare const grecaptcha: any;

@Component({
  selector: 'app-cusrsus-item',
  templateUrl: './cusrsus-item.component.html',
  styleUrls: ['./cusrsus-item.component.scss'],
  encapsulation: ViewEncapsulation.None,
  animations: [...fadeAnim]
})
export class CusrsusItemComponent implements OnInit, OnDestroy {

  @ViewChild('fileInput') fileInput: ElementRef;
  public data$: Observable<any>;
  public cvDisabled = false;
  public cvFileName = '';
  public cursus$: Observable<any>;
  public currentCursus = null;
  public currentRoute = '';
  public formations$: Observable<any[]>;
  public frontEndFormations$: Observable<any[]>;
  public backEndFormations$: Observable<any[]>;
  public marketingFormations$: Observable<any[]>;
  public incriptionForm: FormGroup;
  public loading: HTMLIonLoadingElement;
  private subscription: Subscription;
  // public captchaKey = environment.recaptcha;

  baseUrl = [
    'https://nomades.ch/wp-content/uploads/2018/10/nomade01-.png',
    'https://nomades.ch/wp-content/uploads/2018/10/nomade03-.png',
  ];

  constructor(
    private _wpApi: WpApiService,
    private _route: ActivatedRoute,
    private _router: Router,
    private _fb: FormBuilder,
    private _alertCtrl: AlertController,
    private _loadingCtrl: LoadingController,
    // private recaptchaV3Service: ReCaptchaV3Service,
  ) {
    console.log(this._route.snapshot.params.slug);
    this.currentRoute = this._route.snapshot.params.slug;
    this.incriptionForm = this._fb.group({
      prenom: [null, Validators.required],
      nom: [null, Validators.required],
      email: [null, Validators.required],
      phone: [null, Validators.required],
      cv: [null, Validators.required],
      captcha: [''],
      email_confirmation: [null],
      formations: new FormArray([], Validators.required),
    });
   }

  ngOnInit() {
    // this.subscription = this.recaptchaV3Service.onExecute
    // .subscribe((data: OnExecuteData) => {
    //   console.log('handleRecaptchaExecute->', data);
    //   // this.handleRecaptchaExecute(data.action, data.token);
    // });
    // loadFile(this);
    this.formations$ = this._wpApi.getRemoteData({path: 'formation', slug: ``}).pipe(
      map(res => res.map(item => {item.formation_position = +item.formation_position; return item; })),
      map((res) => res.sort((a, b) => a.formation_position - b.formation_position))
    );
    this.data$ = this._wpApi.getData({path: 'pages', slug: `slug=cursus`}).pipe(
      map(res => (res.length === 1 ) ? res[0] : res),
    );
    this.cursus$ = this._wpApi.getData({path: 'cursus', slug: ``}).pipe(
      map(res => (res.length === 1 ) ? res[0] : res),
      map((res: any[]) => {
        const cc = res.find(c => c.slug === this.currentRoute);
        const oc = res.filter(c => c.slug !== this.currentRoute);
        oc.push(cc);
        return oc;
      }),
      tap(cs => (this.currentCursus = cs.find(c => c.slug === this.currentRoute))),
    );

    this.frontEndFormations$ = this.formations$.pipe(
      map(formations => formations.filter(f => f.cursus[0] === 2).sort((a, b) => a.formation_position - b.formation_position))
    );
    this.backEndFormations$ = this.formations$.pipe(
      map(formations => formations.filter(f => f.cursus[0] === 3).sort((a, b) => a.formation_position - b.formation_position))
    );
    this.marketingFormations$ = this.formations$.pipe(
      map(formations => formations.filter(f => f.cursus[0] === 23).sort((a, b) => a.formation_position - b.formation_position))
    );
  }

  ngOnDestroy() {
    if (this.subscription) {
      this.subscription.unsubscribe();
    }
  }

  go(link) {
    console.log(link);
    this._router.navigate(['/cursus/' + link]);
  }

  getdetail(u: string) {
    const w = window.open('https://nomades.ch/wp-content/' + u.split('/wp-content').reverse()[0], '_blank');
    w.focus();
  }


  async processWeb() {
    // console.log(this.fileInput, (this.fileInput.nativeElement).files[0]);
    if (this.cvDisabled) {
      return;
    }
    this.cvDisabled = !this.cvDisabled;

    const reader = new FileReader();
    reader.onload = (readerEvent) => {
      const fileData = (readerEvent.target as any).result;
      console.log('XXXX', fileData);
    };
    if ((this.fileInput.nativeElement as any).files.length) {
      const file = (this.fileInput.nativeElement).files[0];
      // assuming that this file has any extension
      // const extension = file.name.match(/(?<=\.)\w+$/g)[0].toLowerCase();
      // if (!['pdf'].includes(extension)) {
      if (!file.name.toLowerCase().includes('pdf')) {
        (this.fileInput.nativeElement as any).value = '';
        // this.disabled = false;
        const alert = await this._alertCtrl.create({
          header: 'Erreur',
          message: 'Error: Le format du fichier est incompatible ou non conforme. Uniquement des fichier PDF.',
          buttons: [{
            text: 'ok'
          }]
        });
        alert.present();
        this.cvDisabled = false;
        this.cvFileName = '';
        this.incriptionForm.get('cv').setValue(null);
        return;
      }
      this.cvFileName = file.name;
      this.incriptionForm.get('cv').setValue(file);
      this.cvDisabled = false;
      // (this.fileInput.nativeElement as any).value = '';
    }
  }

  openFile() {
    this.fileInput.nativeElement.click();
  }
  toggle(block: HTMLElement) {
    console.log(block);
    block.classList.toggle('open');
  }

  inscription() {
    if (!this.currentCursus) {
      return;
    }
    console.log('Confirm', this.currentCursus.id);
    let data = JSON.parse(localStorage.getItem('nomades_formations') || '[]');
    if (!data.find(i => i.id === this.currentCursus.id)) {
      data = [...data, this.currentCursus];
    }
    localStorage.setItem('nomades_formations', JSON.stringify(data));
    this._router.navigate(['./inscription']);
  }

  async dateChange($event, formation, checkBox) {
    if (formation) { return; }
    if (!$event.target.value) { return; }
    if (!checkBox.checked) { return; }
    const formationGroup = (this.incriptionForm.get('formations') as FormArray);
    // add formation logic:
    const index = formationGroup.controls.findIndex(c => c.value.id === formation.id);
    // find existing and remove formation
    if (index >= 0) {
      formationGroup.removeAt(index);
      // console.log('existing removed...', this.incriptionForm.value);
    }
    // if formation is selected...
    if ($event.detail.checked) {
      // insert new item in form
      formationGroup.insert(0, new FormGroup({
        id: new FormControl(formation.id),
        name: new FormControl(formation.title.rendered),
        price: new FormControl(formation.formation_price),
        date: new FormControl($event.target.value)
      }));
    }
    this.incriptionForm.markAsDirty();
    console.log('value->', this.incriptionForm.value);
  }
  async checkBoxChange($event, formation, date: HTMLIonSelectElement) {
    console.log('$event', date);
    let afterSelectedDate;
    if ((!date || !date.value) && $event.target.checked) {
      const ionAlert = await date.open();
      const response = await ionAlert.onDidDismiss();
      if (!response.data.values) {
        $event.target.checked = false;
        return;
      }
      afterSelectedDate = response.data.values;
      console.log('--->', afterSelectedDate);
      // const alert = await this._alertCtrl.create({
      //   header: 'Inscription',
      //   message: `Veuillez choisir une date pour séléctionner une formation`,
      //   buttons: [{text: 'ok'}
      //   ]
      // });
      // const alertError = await alert.present().catch(err => err);
      // // toggle checkbox state
      // $event.target.checked = false;
      // if (alertError) console.log(alertError);
      // return;
    }
    const dateFromTo = date.value || afterSelectedDate;
    const formationGroup = (this.incriptionForm.get('formations') as FormArray);
    // add formation logic:
    const index = formationGroup.controls.findIndex(c => c.value.id === formation.id);
    // find existing and remove formation
    if (index >= 0) {
      formationGroup.removeAt(index)
      // console.log('existing removed...', this.incriptionForm.value);
    }
    // if formation is selected...
    if ($event.detail.checked) {
      // insert new item in form
      formationGroup.insert(0, new FormGroup({
        id: new FormControl(formation.id),
        name: new FormControl(formation.title.rendered),
        price: new FormControl(formation.formation_price),
        date: new FormControl(dateFromTo)
      }));
    }
    this.incriptionForm.markAsDirty();
    console.log('value->', this.incriptionForm.value);
  }

  async clickSend(captchaRef = null) {
    if (!this.incriptionForm.valid) {
      const ionAlert = await this._alertCtrl.create({
        message: `Formulaire d'inscription non valide.`
      });
      await ionAlert.present();
      return;
    }
    // create loader
    this.loading = await this._loadingCtrl.create({
      message: 'envoi de votre inscription...',
      // duration: 20000
    });
    await this.loading.present();
    // execute invisible captcha v3
    // if (captchaRef) captchaRef.execute();
    // if (!captchaRef) grecaptcha.execute();
    // console.log('captchaRef', captchaRef);
    // prevent error when captchaRef.execute()
    // // never return callback...
    // setTimeout(async (_) => {
    //   if (this.loading) {
    //     await this.loading.dismiss();
    //     this.loading = null;
    //     const ionAlert = await this._alertCtrl.create({
    //       message: `Erreur lors de l'envois de votre inscription. Veuiller re-ressayer ou contacter le secrétariat.`
    //     });
    //     ionAlert.present();
    //   }
    // }, 20000);
    this.submit('nomades' + this.incriptionForm.value.captcha)
  }

  submit(e) {
    console.log('submit callback reCAPTCHA', e);
    if (!e) { return; }
    // patch captcha value to form data
    this.incriptionForm.patchValue({captcha: e});
    // then request send data to backend
    this.sendInscription();
  }

  async sendInscription() {
    // close loader if exist
    if (this.loading) { (this.loading.dismiss(), this.loading = null); }
    // create empty prop for all alert message
    let ionAlert: HTMLIonAlertElement;
    // handle form errors
    if (!this.incriptionForm.valid) {
      // crearte error alert
      ionAlert = await this._alertCtrl.create({
        message: 'formulaire non valide',
        buttons: [{
          text: 'ok'
        }]
      });
      // display and stop script
      if (ionAlert) { await ionAlert.present(); }
      return;
    }
    // request backend with form data valid
    const response = await this._wpApi.sendInscription(this.incriptionForm.value);
    // handle response status
    if (response.result === 200) {
      // create success alert
      ionAlert = await this._alertCtrl.create({
        message: 'Votre inscription à été envoyée.',
        buttons: [{
          text: 'ok'
        }]
      });
    }
    else {
      // create error alert
      ionAlert = await this._alertCtrl.create({
        header: 'Erreur',
        message: `Votre inscription n'a pas été envoyée. Veuillez nous contacter par téléphone.`,
        buttons: [{
          text: 'ok'
        }]
      });
    }
    // display alert
    if (ionAlert) { await ionAlert.present(); }
    // reset inscription form
    this.incriptionForm.reset();
  }
}
