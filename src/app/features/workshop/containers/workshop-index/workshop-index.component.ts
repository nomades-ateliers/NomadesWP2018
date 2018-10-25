import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';
import { map, tap } from 'rxjs/operators';

import { WpApiService } from '@app/shared/services';

@Component({
  selector: 'app-workshop-index',
  templateUrl: './workshop-index.component.html',
  styleUrls: ['./workshop-index.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class WorkshopIndexComponent implements OnInit {


  public data$: Observable<any>;
  public currentUrl: any;
  baseUrl = 'https://nomades.ch/wp-content/uploads/2018/10/nomade02-.png';

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
