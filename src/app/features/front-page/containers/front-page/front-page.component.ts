import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';
import { WpApiService } from '@app/shared/services';

@Component({
  selector: 'app-front-page',
  templateUrl: './front-page.component.html',
  styleUrls: ['./front-page.component.scss'],
  encapsulation: ViewEncapsulation.ShadowDom
})
export class FrontPageComponent implements OnInit {

  public data$: Observable<any>;
  baseUrl = 'https://nomades.ch/wp-content/themes/theme_nomades';
  constructor(private _wpApi: WpApiService) { }

  ngOnInit() {
    this.data$ = this._wpApi.getData({path: 'pages', slug: `slug=index`}).pipe(
      map(res => (res.length === 1 ) ? res[0] : res)
    );
  }

}
