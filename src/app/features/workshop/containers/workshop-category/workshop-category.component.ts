import { Component, OnInit, ViewEncapsulation, AfterViewInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { WpApiService } from '@app/shared/services';
import { map, tap } from 'rxjs/operators';
import { Observable } from 'rxjs';
import { fadeAnim } from '@app/shared/animations/fade.animation';
import { updateHTMLElementHeight } from '@app/utils';
@Component({
  selector: 'app-workshop-category',
  templateUrl: './workshop-category.component.html',
  styleUrls: ['./workshop-category.component.scss'],
  encapsulation: ViewEncapsulation.None,
  animations: [...fadeAnim]
})
export class WorkshopCategoryComponent implements OnInit {

  public currentUrl: any;
  public baseUrl = [
    'https://nomades.ch/wp-content/uploads/2018/10/nomade04-.png', // vert
    'https://nomades.ch/wp-content/uploads/2018/11/nomade05_jaune-png.png', // default => TODO: replace by yellow
    'https://nomades.ch/wp-content/uploads/2018/10/nomade03-.png' // bleu
  ];
  // public parcour: any;
  public parcours: any;
  public workshops$: Observable<any>;
  public workshopsLenght: number;
  public data$: any;

  constructor(
    private _router: Router,
    private _route: ActivatedRoute,
    private _http: WpApiService
  ) { }

  ngOnInit() {
    this.currentUrl = this._router.url;
    console.log('currentUrl', this.currentUrl);

    this._loadParcours();
  }

  ionViewWillEnter() {
    // let arts = [...Array.from(document.querySelectorAll('article'))]
    // if (arts.length <= 0) this.updateHeight(arts);
  }

  go(url: string) {
    console.log('go to: ', url);
    this._router.navigate(['workshops/' + url]);
  }

  displayDetail(slug, item) {

    const { category } = this._route.snapshot.params;
    const url = '/workshops/' + category + '/' + slug + '/' + item.slug;
    console.log('go-> ', url);
    this._router.navigate([url]);
  }

  private _loadParcours() {
    console.log('..._loadParcours');
    const { category: slug } = this._route.snapshot.params;
    let parcour;
    console.log(slug);
    // get all workshop parcours
    this.data$ = this._http.getRemoteData({path: 'parcours', slug: 'per_page=100'}).pipe(
      // load to tempory list for searching later
      tap(res => this.parcours = res),
      // find coresponding parcours by slug
      map(res => res.find(i => i.slug === slug)),
      // define parcour model required propety
      tap(res => parcour = res || {}),
      map(_ => this.parcours
          // filter from tempory list item with parent === parcour.id
          .filter(i => i.parent === parcour.id)
          // filter only caregories with children count > 0
          .filter(i => +i.count >= 1)
          // order parcours by proprety
          .sort((a, b) => a.order - b.order)
      ),
      tap(_ => this.parcours = this.parcours.filter(p => p.parent === 0).sort((a, b) => a.order - b.order)),
      // tap((res: any[]) => {
      //   console.log('XXX', this.parcours);
      //   const cc = this.parcours.find(c => c.slug === this._router.url.split('/').reverse()[0]);
      //   const oc = this.parcours.filter(c => c.slug !== this._router.url.split('/').reverse()[0]);
      //   // this.parcours = oc.push(cc);
      //   console.log('cc oc', this.parcours);
      // }),
      tap(res => this._loadWorkshops(parcour.id)),
      // add this to update all item with the same height size.
      tap(_ => updateHTMLElementHeight(['article'])),
      tap(_ => updateHTMLElementHeight(['h1']))
    );
  }

  private _loadWorkshops(id: string) {

    this.workshops$ = this._http.getRemoteData({path: 'workshop', slug: 'per_page=100'}).pipe(
      map(wks => wks.sort((a, b) => a.wk_position - b.wk_position)),
      // tap(w => this.workshopsLenght = w.length),
      tap(w => console.log(w))
    );
  }

  get category() {
    return this._route.snapshot.params.category;
  }
}
