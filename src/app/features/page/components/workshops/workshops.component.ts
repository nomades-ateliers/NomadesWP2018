import { Component, OnInit, Input, ViewEncapsulation } from '@angular/core';
import { Router } from '@angular/router';
import { WpApiService } from '@app/shared/services';
import { map, tap } from 'rxjs/operators';

@Component({
  selector: 'app-workshops',
  templateUrl: './workshops.component.html',
  styleUrls: ['./workshops.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class WorkshopsComponent implements OnInit {

  @Input() data$: any;
  constructor(
    private _router: Router,
    private _wpApi: WpApiService
  ) { }

  ngOnInit() {
    this.data$ = this._wpApi.getRemoteData({path: 'workshop', slug: ``}).pipe(
      map(res => (res.length === 1 ) ? res[0] : res),
      map(w => w.sort((wk: any) => wk.wk_position).reverse())
      // tap(data => (!data.type) ? window.location.href = '404' : null)
    );
  }

}
