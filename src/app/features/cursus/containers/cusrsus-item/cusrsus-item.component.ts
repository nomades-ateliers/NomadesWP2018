import { Component, OnInit, ViewEncapsulation, ElementRef, ViewChild } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

import { Observable } from 'rxjs';
import { map, tap } from 'rxjs/operators';

import { WpApiService } from '@app/shared/services';
import { fadeAnim } from '@app/shared/animations/fade.animation';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';


@Component({
  selector: 'app-cusrsus-item',
  templateUrl: './cusrsus-item.component.html',
  styleUrls: ['./cusrsus-item.component.scss'],
  encapsulation: ViewEncapsulation.None,
  animations: [...fadeAnim]
})
export class CusrsusItemComponent implements OnInit {

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

  baseUrl = [
    'https://nomades.ch/wp-content/uploads/2018/10/nomade01-.png',
    'https://nomades.ch/wp-content/uploads/2018/10/nomade03-.png',
  ];

  constructor(
    private _wpApi: WpApiService,
    private _route: ActivatedRoute,
    private _router: Router,
    private _fb: FormBuilder
  ) {
    console.log(this._route.snapshot.params.slug);
    this.currentRoute = this._route.snapshot.params.slug;
    this.incriptionForm = this._fb.group({
      prenom: [null, Validators.required],
      nom: [null, Validators.required],
      email: [null, Validators.required],
      phone: [null, Validators.required],
      cv: [null, Validators.required],
      formations: [null, Validators.required],
    });
   }

  ngOnInit() {
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

  go(link) {
    console.log(link);
    this._router.navigate(['/cursus/' + link]);
  }

  getdetail(u: string) {
    const w = window.open('https://nomades.ch/wp-content/' + u.split('/wp-content').reverse()[0], '_blank');
    w.focus();
  }


  processWeb() {
    // console.log(this.fileInput);
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
      this.cvFileName = file.name;
      // assuming that this file has any extension

      // const extension = file.name.match(/(?<=\.)\w+$/g)[0].toLowerCase();

      // if (this.exts && !this.exts.includes(extension)) {
      //   (this.fileInput.nativeElement as any).value = '';
      //   this.disabled = false;
      //   return this.dataToSend.emit({message: 'Error: Le format du fichier est incompatible ou non conforme.'});
      // }
      this.cvDisabled = false;
      (this.fileInput.nativeElement as any).value = '';
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

  sendInscription() {
    console.log(this.incriptionForm.valid);
    if (!this.incriptionForm.valid) {
      return alert('formulaire non valide');
    }
    alert('pas encore codé... attend confirtation du changement...');
    this.incriptionForm.reset();
  }
}
