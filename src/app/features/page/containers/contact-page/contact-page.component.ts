import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { FormGroup, FormBuilder, Validators, FormControl } from '@angular/forms';
import { WpApiService } from '@app/shared/services';
import { AlertController, LoadingController } from '@ionic/angular';
import { loadFile } from '@app/utils';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';
import { environment } from '@env/environment';

// declare const grecaptcha: any;

@Component({
  selector: 'app-contact-page',
  templateUrl: './contact-page.component.html',
  styleUrls: ['./contact-page.component.scss'],
  // providers: [{
  //   provide: RECAPTCHA_URL,
  //   useValue: 'http://localhost:3000/validate_captcha'
  // }],
  encapsulation: ViewEncapsulation.None
})
export class ContactPageComponent implements OnInit {
  
  // public data$: Observable<any>;
  form: FormGroup;
  loader: HTMLIonLoadingElement  
  slideOpts = {
    loop: true,
    effect: 'fade',
    speed: 1000,
    autoplay: {
      delay: 5000,
    },
  };
  public captchaKey = environment.recaptcha;

  constructor(
    private readonly _formBuilder: FormBuilder,
    private _http: WpApiService,
    private _alertCtrl: AlertController,
    private _loadingCtrl: LoadingController
  ) { }

  ngOnInit() {
    if (!document.querySelector('#google')) {
      const s = document.createElement('script');
      s.id = 'google';
      s.src = 'https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit';
      document.body.appendChild(s);
    }
    window['onloadCallback'] = () => {
      grecaptcha.render('html_element', {
        'sitekey' : '6LdZQnUUAAAAADEBOR-Y2LTtnT1m6CYrrt9qJ7u5'
      });
    };
    // this.data$ = this._http.getData({path: 'pages', slug: `slug=contact`}).pipe(
    //   map(res => (res.length === 1 ) ? res[0] : res),
    // );
    // load JS file
    // loadFile(this);
    // build contact form
    this._buildForm();
  }

  private _buildForm() {
    this.form = this._formBuilder.group({
      nom: ['', Validators.compose([Validators.required, Validators.minLength(2)])],
      prenom: ['', Validators.compose([Validators.required, Validators.minLength(2)])],
      email: ['', Validators.compose([Validators.required, Validators.email])],
      objet: ['', Validators.compose([Validators.required, Validators.minLength(2)])],
      message: ['', Validators.compose([Validators.required, Validators.minLength(1)])],
      ajax: ['true'],
      captcha: [''],
      copy: [false],
      email_confirmation: [''],
    });
  }

  async submit() {
    if (!this.form.valid) {
      console.log('invalid form data');
      return;
    }
    this.loader = await this._loadingCtrl.create({
      message: 'envois du message en cours...',
      duration: 10000
    })
    this.loader.present();
    // to prevent multiple sending action
    this.form.markAsPristine();
    // validation recaptcha
    // grecaptcha.execute();
    this.onSubmit('nomades' + this.form.value.email_confirmation || '')
  }

  onSubmit(e) {
    console.log('submit callback reCAPTCHA', e);
    if (!e) return;
    this.form.patchValue({captcha: e})
    this._sendDataForm();
    // rebuild form with initial data
    this._buildForm();
    this.form.reset();
  }

  private _sendDataForm() {
    // if(grecaptcha) grecaptcha.execute();
    if (this.form.value.captcha !== 'nomades') return;
    console.log('send', this.form.value);
    // return;
    this._http.sendMail(this.form.value)
    .then((res: any) => this._displayNotif(res))
    .then((res: any) => (res.result === 200) ? (this._buildForm(), res) : res)
    // display user notification error
    .catch(err => console.log(err));
  }

  async _displayNotif(res) {
    const { result = null} = res;
    if (!result) return;
    if (this.loader) this.loader.dismiss();
    let alertElement: HTMLIonAlertElement
    switch(true) {
      case result === 200:
        alertElement = await this._alertCtrl.create({
          subHeader: `Merci pour l'envoi de votre message !`,
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
}
