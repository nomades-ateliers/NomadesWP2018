import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';
import { map, tap } from 'rxjs/operators';

import { WpApiService } from '@app/shared/services';

@Component({
  selector: 'app-page',
  templateUrl: './page.component.html',
  styleUrls: ['./page.component.scss']
})
export class PageComponent implements OnInit {

  public data$: Observable<any>;
  public currentUrl: any;
  baseUrl = 'https://nomades.ch/wp-content/themes/theme_nomades';

  constructor(
    private _router: Router,
    private _route: ActivatedRoute,
    private _wpApi: WpApiService) { }

  ngOnInit() {

    this.currentUrl = this._router.url;
    this.data$ = this._wpApi.getData({path: 'pages', slug: `slug=${this._router.url.split('/').reverse()[0]}`}).pipe(
      map(res => (res.length === 1 ) ? res[0] : res),
      tap(data => (!data.type) ? window.location.href = '404' : null)
    );
  }

}
