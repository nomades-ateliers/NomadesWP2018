import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { Router } from '@angular/router';
import { FormBuilder, FormGroup, FormArray, Validators } from '@angular/forms';

@Component({
  selector: 'app-inscription',
  templateUrl: './inscription.component.html',
  styleUrls: ['./inscription.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class InscriptionComponent implements OnInit {

  currentUrl: any;
  baseUrl = 'https://nomades.ch/wp-content/themes/theme_nomades';
  form: FormGroup;
  wksList: any[];
  totalEcolage = 0;

  constructor(
    private _router: Router,
    private readonly _formBuilder: FormBuilder,
  ) { }

  ngOnInit() {
    this.currentUrl = this._router.url;
    this._buildForm();
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
      name: ['', Validators.compose([Validators.required, Validators.minLength(2)])],
      firstname: ['', Validators.compose([Validators.required, Validators.minLength(2)])],
      bday: ['', Validators.compose([Validators.required, Validators.minLength(2)])],
      job: [''],
      email: ['', Validators.compose([Validators.required, Validators.email])],
      adress: [''],
      npa: [''],
      city: [''],
      workshops: this._formBuilder.array([])
    });
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

  submit() {
    console.log(this.form.valid, this.form.value);
    // to prevent multiple sending action
    this.form.markAsPristine();
    // rebuild form with initial data
    this._buildForm();
    // clear localstorage
    localStorage.removeItem('nomades_workshop');
  }
}
