import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { Router } from '@angular/router';
import { FormBuilder, FormGroup, FormArray } from '@angular/forms';

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
    this.form.patchValue({workshops: []});
  }
  ionViewWillEnter() {
    console.log('enter...', JSON.parse(localStorage.getItem('nomades_workshop') || '[]'));
    this.form.patchValue({workshops: []});
    this.wksList = JSON.parse(localStorage.getItem('nomades_workshop') || '[]');
    this.wksList.map(c => this.getControl().push(this._formBuilder.control(c)));
    this.form.patchValue({workshops: this.wksList});
    this.wksList.map(i => {
      this.totalEcolage = this.totalEcolage + (+i.ecolage_wk);
      return i;
    });
  }

  private _buildForm() {
    this.form = this._formBuilder.group({
      name: [],
      firstname: [],
      bday: [],
      job: [],
      email: [],
      adress: [],
      npa: [],
      city: [],
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
  }
}
