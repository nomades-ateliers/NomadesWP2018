import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { FormGroup, FormBuilder, Validators, FormControl } from '@angular/forms';
import { WpApiService } from '@app/shared/services';
import { first } from 'rxjs/operators';
// import SmtpClient from 'emailjs-smtp-client';
// const sendmail = require('sendmail')({
//   smtpHost: 'mail.infomaniak.com',
//   // smtpPort: 1025
// });
// const client = new SmtpClient('mail.infomaniak.com');
// client.onidle = () => {
//   console.log('Connection has been established');
//   // this event will be called again once a message has been sent
//   // so do not just initiate a new message here, as infinite loops might occur
// };
// let alreadySending = false;
// client.onidle = () => {
//   if (alreadySending) {return; }
//   alreadySending = true;
//   client.useEnvelope({
//     from: 'me@example.com',
//     to: ['info@nomades.ch']
//   });
// };
// client.onready = (failedRecipients) => {
//   if (failedRecipients.length) {
//     console.log('The following addresses were rejected: ', failedRecipients);
//   }
//   // start transfering the e-mail
//   client.send('Subject: test\r\n');
//   client.send('\r\n');
//   client.send('Message body');
//   client.end();
// };
// client.ondone = function(success) {
//   if (success) {
//     console.log('The message was transmitted successfully');
//   }
//   client.close();
// };
declare const grecaptcha: any;

@Component({
  selector: 'app-contact-page',
  templateUrl: './contact-page.component.html',
  styleUrls: ['./contact-page.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class ContactPageComponent implements OnInit {
  form: FormGroup;
  myRecaptcha = new FormControl();

  constructor(
    private readonly _formBuilder: FormBuilder,
    private _http: WpApiService
  ) { }

  ngOnInit() {
    // load JS file
    this._loadFile();
    this._buildForm();
  }

  _loadFile() {
    if (typeof grecaptcha !== 'undefined') {
      return;
    }
    if (navigator.onLine === false) {
      return;
    }
    const  script: HTMLScriptElement = document.createElement('script');
    script.id = 'grecaptcha';
    script.async = true;
    script.defer = true;
    script.src = 'https://www.google.com/recaptcha/api.js?sitekey=6LeAHWEUAAAAAD9DQDvlI8EMFkfNvf69SUtJpnt3';
    document.body.appendChild(script);
    console.log(script);
    
    window['onSubmit'] = (e) => {
      console.log('callbackcalled...');
      // if (!grecaptcha) {
      //   return;
      // }
      // (grecaptcha as any).render('grecaptcha', {
      //   'sitekey' : '6LeAHWEUAAAAAD9DQDvlI8EMFkfNvf69SUtJpnt3',
      //   'callback' : this.onSubmit,
      //   'theme' : 'dark'
      // });
      this.onSubmit(e);
    };
  }

  private _buildForm() {
    this.form = this._formBuilder.group({
      nom: ['', Validators.compose([Validators.required, Validators.minLength(2)])],
      prenom: ['', Validators.compose([Validators.required, Validators.minLength(2)])],
      email: ['', Validators.compose([Validators.required, Validators.email])],
      objet: ['', Validators.compose([Validators.required, Validators.minLength(2)])],
      message: ['', Validators.compose([Validators.required, Validators.minLength(5)])],
      ajax: ['true'],
    });
  }

  private _sendDataForm() {
    console.log('send', this.form.value);
    this._http.sendMail(this.form.value)
    // .then(res => (res.status === 200)
    //   ? res.json()
    //   : null 
    // )
    // display user notification success
    .then(res => console.log(res))
    // display user notification error
    .catch(err => console.log(err));
  }

  onSubmit(e) {
    console.log('submit callback reCAPTCHA');
  }
  onload() {
    console.log('Google reCAPTCHA loaded and is ready for use!');
  }

  onScriptError() {
      console.log('Something went long when loading the Google reCAPTCHA');
  }

  submit() {
    if (!this.form.valid) {
      console.log('invalid form data');
      return;
    }
    // to prevent multiple sending action
    this.form.markAsPristine();
    this._sendDataForm();
    // rebuild form with initial data
    this._buildForm();
  }
}
