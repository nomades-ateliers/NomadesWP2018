import { Component, OnInit } from '@angular/core';
import { map, tap } from 'rxjs/operators';
import { WpApiService } from '@app/shared/services';
import { ActivatedRoute, Router } from '@angular/router';
import { Observable } from 'rxjs';

@Component({
  selector: 'app-not-found',
  templateUrl: './not-found.component.html',
  styleUrls: ['./not-found.component.scss']
})
export class NotFoundComponent implements OnInit {

  public data$: Observable<any>;
  public currentUrl: any;
  baseUrl = 'https://nomades.ch/wp-content/uploads/2018/10/nomades01_rouge2.gif';

  constructor(
    private _router: Router,
    private _route: ActivatedRoute,
    private _wpApi: WpApiService) { }

  ngOnInit() {
      this.currentUrl = this._router.url;
      this.data$ = this._wpApi.getData({path: 'pages', slug: `slug=${this._router.url.split('/').reverse()[0]}`}).pipe(
        map(res => (res.length === 1 ) ? res[0] : res),
      );
    }
}
