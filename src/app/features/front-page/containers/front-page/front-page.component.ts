import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { Router } from '@angular/router';
import { Observable } from 'rxjs';
import { map, tap } from 'rxjs/operators';

import { WpApiService } from '@app/shared/services';

@Component({
  selector: 'app-front-page',
  templateUrl: './front-page.component.html',
  styleUrls: ['./front-page.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class FrontPageComponent implements OnInit {

  public data$: Observable<any>;
  public cursus$: Observable<any>;
  baseUrl = 'https://nomades.ch/wp-content/uploads/2018/10/nomades01_rouge2.gif';

  constructor(
    private _wpApi: WpApiService,
    private _router: Router
  ) { }

  ngOnInit() {
    this.data$ = this._wpApi.getData({path: 'pages', slug: `slug=index`}).pipe(
      map(res => (res.length === 1 ) ? res[0] : res),
    );
    this.cursus$ = this._wpApi.getData({path: 'cursus', slug: ``}).pipe(
      map(res => (res.length === 1 ) ? res[0] : res),
      map((c: any[]) => c.sort((a, b) => (+a.sort) - (+b.sort))),
      tap(d => console.log('---', d))
    );
  }

  go(link) {
    console.log(link);
    this._router.navigate(['/cursus/' + link]);
  }

}
