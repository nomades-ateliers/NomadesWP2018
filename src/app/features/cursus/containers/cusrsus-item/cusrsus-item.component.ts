import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';

import { WpApiService } from '@app/shared/services';

@Component({
  selector: 'app-cusrsus-item',
  templateUrl: './cusrsus-item.component.html',
  styleUrls: ['./cusrsus-item.component.scss']
})
export class CusrsusItemComponent implements OnInit {

  public data$: Observable<any>;
  public cursus$: Observable<any>;
  public currentRoute = '';
  public formations$: Observable<any[]>;
  public frontEndFormations$: Observable<any[]>;
  public backEndFormations$: Observable<any[]>;

  baseUrl = 'https://nomades.ch/wp-content/themes/theme_nomades';
  constructor(
    private _wpApi: WpApiService,
    private _route: ActivatedRoute,
    private _router: Router
  ) {
    console.log(this._route.snapshot.params.slug);
    this.currentRoute = this._route.snapshot.params.slug;
   }

  ngOnInit() {
    this.formations$ = this._wpApi.getRemoteData({path: 'formation', slug: ``});
    this.data$ = this._wpApi.getData({path: 'pages', slug: `slug=cursus`}).pipe(
      map(res => (res.length === 1 ) ? res[0] : res),
    );
    this.cursus$ = this._wpApi.getData({path: 'cursus', slug: ``}).pipe(
      map(res => (res.length === 1 ) ? res[0] : res),
    );

    this.frontEndFormations$ = this.formations$.pipe(
      map(formations => formations.filter(f => f.cursus[0] === 2).sort(f => f.formation_position))
    );
    this.backEndFormations$ = this.formations$.pipe(
      map(formations => formations.filter(f => f.cursus[0] === 3).sort(f => f.formation_position))
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
}
