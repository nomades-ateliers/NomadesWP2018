import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs';
import { map, tap } from 'rxjs/operators';

import { WpApiService } from '@app/shared/services';

@Component({
  selector: 'app-workshop-item',
  templateUrl: './workshop-item.component.html',
  styleUrls: ['./workshop-item.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class WorkshopItemComponent implements OnInit {



  public data$: Observable<any>;
  public currentUrl: any;
  baseUrl = 'https://nomades.ch/wp-content/themes/theme_nomades';

  constructor(
    private _router: Router,
    private _route: ActivatedRoute,
    private _wpApi: WpApiService) { }

  ngOnInit() {

    this.currentUrl = this._router.url;
    console.log('--', this._router.url.split('/').reverse()[0]);

    this.data$ = this._wpApi.getRemoteData({path: 'workshop', slug: `slug=${this._router.url.split('/').reverse()[0]}`}).pipe(
      map(res => (res.length === 1 ) ? res[0] : res),
      tap(data => (!data.type) ? window.location.href = '404' : null)
    );
  }
}
