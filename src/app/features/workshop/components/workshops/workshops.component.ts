import { Component, OnInit, Input, ViewEncapsulation } from '@angular/core';
import { Router } from '@angular/router';
import { WpApiService } from '@app/shared/services';
import { map, tap } from 'rxjs/operators';
import { Observable } from 'rxjs';

@Component({
  selector: 'app-workshops',
  templateUrl: './workshops.component.html',
  styleUrls: ['./workshops.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class WorkshopsComponent implements OnInit {

  public data$: Observable<any>;

  constructor(
    private _router: Router,
    private _wpApi: WpApiService
  ) { }

  ngOnInit() {
    this.data$ = this._wpApi.getRemoteData({path: 'parcours', slug: `per_page=100`}).pipe(
      map(res => (res.length === 1 ) ? res[0] : res),
      map(ps => ps.filter(p => p.parent === 0)),
      map(ps => ps.sort((a, b) => a.order - b.order))
      // tap(data => (!data.type) ? window.location.href = '404' : null)
    );
  }

  go(url: string) {
    console.log('...go: ', url);
    this._router.navigate(['/workshops/' + url]);
  }

}
