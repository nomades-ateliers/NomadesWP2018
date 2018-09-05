import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { WpApiService } from '@app/shared/services';
import { first, map, tap, switchMap } from 'rxjs/operators';
import { Observable } from 'rxjs';

@Component({
  selector: 'app-workshop-category',
  templateUrl: './workshop-category.component.html',
  styleUrls: ['./workshop-category.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class WorkshopCategoryComponent implements OnInit {

  public currentUrl: any;
  public baseUrl = 'https://nomades.ch/wp-content/themes/theme_nomades';
  public parcour: any;
  public parcours: any;
  public workshops$: Observable<any>;
  public data$: any;

  constructor(
    private _router: Router,
    private _route: ActivatedRoute,
    private _http: WpApiService
  ) { }

  ngOnInit() {
    this.currentUrl = this._router.url;
    this._loadParcours();
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
    const { category: slug } = this._route.snapshot.params;
    console.log(slug);
    // get all workshop parcours
    this.data$ = this._http.getRemoteData({path: 'parcours', slug: 'per_page=100'}).pipe(
      // load to tempory list for searching later
      tap(res => this.parcours = res),
      // find coresponding parcours by slug
      map(res => res.find(i => i.slug === slug)),
      // define parcour model required propety
      tap(res => this.parcour = res || {}),
      map(_ => this.parcours
          // filter from tempory list item with parent === parcour.id
          .filter(i => i.parent === this.parcour.id)
          // filter only caregories with children count > 0
          .filter(i => +i.count >= 1)
      ),
      tap(res => this._loadWorkshops(this.parcour._id)),
      tap(_ => this.parcours = this.parcours.filter(p => p.parent === 0))
      // first()
    );
    // .toPromise();
    // .then(res => console.log(res));
  }

  private _loadWorkshops(id: string) {
    this.workshops$ = this._http.getRemoteData({path: 'workshop', slug: 'per_page=100'}).pipe(
      // map(wks => wks.filter)
    );
  }

  get category() {
    return this._route.snapshot.params.category;
  }
}
