import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

import { Observable } from 'rxjs';
import { map, tap } from 'rxjs/operators';

import { WpApiService } from '@app/shared/services';
import { fadeAnim } from '@app/shared/animations/fade.animation';


@Component({
  selector: 'app-cusrsus-item',
  templateUrl: './cusrsus-item.component.html',
  styleUrls: ['./cusrsus-item.component.scss'],
  encapsulation: ViewEncapsulation.None,
  animations: [...fadeAnim]
})
export class CusrsusItemComponent implements OnInit {

  public data$: Observable<any>;
  public cursus$: Observable<any>;
  public currentCursus = null;
  public currentRoute = '';
  public formations$: Observable<any[]>;
  public frontEndFormations$: Observable<any[]>;
  public backEndFormations$: Observable<any[]>;

  baseUrl = [
    'https://nomades.ch/wp-content/uploads/2018/10/nomade01-.png',
    'https://nomades.ch/wp-content/uploads/2018/10/nomade03-.png',
  ]

  constructor(
    private _wpApi: WpApiService,
    private _route: ActivatedRoute,
    private _router: Router
  ) {
    console.log(this._route.snapshot.params.slug);
    this.currentRoute = this._route.snapshot.params.slug;
   }

  ngOnInit() {
    this.formations$ = this._wpApi.getRemoteData({path: 'formation', slug: ``}).pipe(
      map(res => res.map(item => {item.formation_position = +item.formation_position; return item})),
      map((res) => res.sort((a, b) => a.formation_position - b.formation_position))
    );
    this.data$ = this._wpApi.getData({path: 'pages', slug: `slug=cursus`}).pipe(
      map(res => (res.length === 1 ) ? res[0] : res),
    );
    this.cursus$ = this._wpApi.getData({path: 'cursus', slug: ``}).pipe(
      map(res => (res.length === 1 ) ? res[0] : res),
      tap(cs => (this.currentCursus = cs.find(c => c.slug === this.currentRoute)))
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
