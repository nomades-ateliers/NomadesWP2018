import { Component, OnInit, ViewEncapsulation, AfterViewInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { WpApiService } from '@app/shared/services';
import { map, tap } from 'rxjs/operators';
import { Observable } from 'rxjs';
import { fadeAnim } from '@app/shared/animations/fade.animation';

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
    'https://nomades.ch/wp-content/uploads/2018/10/nomade02-.png', // default => TODO: replace by yellow
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

  private _updateHeight() {
    // find all items elements
    const items = Array.from(document.querySelectorAll('article'))
    console.log('_updateHeight items find-> ', items.length);
    // init default maxHeight
    let maxHeight = 0;
    // get height of each element and store the biger in maxHeight
    items.map(i => {
      const iH = i.getBoundingClientRect().height;
      if (iH > maxHeight) maxHeight = iH;
      return i
    })
    // apply maxHeight to all elements
    .map(i => {
      i.style.height = `${maxHeight}px`;
      return i;
    })  
    // re-run function if maxHeight is equal to 0 (unsized elements)
    // or if items.length <= 0 (unfinded elements)
    if (items.length <= 0 || maxHeight === 0) {
      // see below why using setTimeout()...
      setTimeout(_=> this._updateHeight(), 1500);
      return;
    }
    // if all elements is resizing, finaly 
    // remove opacity of each containers with small 
    // setTimeout() to prevent ngFor construction debounce time with ionic element (longer to biuld to the DOM)
    // TODO: check with higher ionic version of 4.0.0-beta.13 if the loading time is the same.
    //       if time is faster with new release, you can remove this setTimeOut and refact the method to
    //       remove all setTimeOut() and working with correct angular pattern design.
    setTimeout(_=> 
      Array.from(document.querySelectorAll('.wks'))
      .map((e: HTMLElement) => {
        e.style.opacity = '1';
      }),
      250
    );
  }

  go(url: string) {
    console.log('go: ', url);
    this._router.navigate(['/workshops/' + url]);
  }

  displayDetail(item) {
    const { category } = this._route.snapshot.params;
    const url = '/workshops/' + category + '/' + item.slug;
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
      ),
      tap(res => this._loadWorkshops(parcour.id)),
      tap(_ => this.parcours = this.parcours.filter(p => p.parent === 0)),
      // add this to update all item with the same height size.
      tap(_ => this._updateHeight())
    );
  }

  private _loadWorkshops(id: string) {

    this.workshops$ = this._http.getRemoteData({path: 'workshop', slug: 'per_page=100'}).pipe(
      // map(wks => wks.filter),
      // tap(w => this.workshopsLenght = w.length),
      tap(w => console.log(w))
    );
  }

  get category() {
    return this._route.snapshot.params.category;
  }
}
