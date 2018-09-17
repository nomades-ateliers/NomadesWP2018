import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';

@Component({
  selector: 'app-contact-page',
  templateUrl: './contact-page.component.html',
  styleUrls: ['./contact-page.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class ContactPageComponent implements OnInit {
  form: FormGroup;

  constructor(
    private readonly _formBuilder: FormBuilder
  ) { }

  ngOnInit() {
    this._buildForm();
  }

  ionViewWillEnter() {
  }

  private _buildForm() {
    this.form = this._formBuilder.group({
      name: ['', Validators.compose([Validators.required, Validators.minLength(2)])],
      firstname: ['', Validators.compose([Validators.required, Validators.minLength(2)])],
      email: ['', Validators.compose([Validators.required, Validators.email])],
      subject: ['', Validators.compose([Validators.required, Validators.minLength(2)])],
      message: ['', Validators.compose([Validators.required, Validators.minLength(5)])],
    });
  }

  private _sendDataForm() {
    console.log('sned', this.form.value);
  }

  submit() {
    if (!this.form.valid) {
      return;
    }
    // to prevent multiple sending action
    this.form.markAsPristine();
    this._sendDataForm();
    // rebuild form with initial data
    this._buildForm();
  }
}
