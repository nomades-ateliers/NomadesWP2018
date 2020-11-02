import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { WpApiService } from '@app/shared/services';
import { Observable } from 'rxjs';
import { fadeAnim } from '@app/shared/animations/fade.animation';
import { tap, map } from 'rxjs/operators';

@Component({
  selector: 'app-projects-page',
  templateUrl: './projects-page.component.html',
  styleUrls: ['./projects-page.component.scss'],
  encapsulation: ViewEncapsulation.None,
  animations: [...fadeAnim]
})
export class ProjectsPageComponent implements OnInit {

  public projects$: Observable<any>;

  constructor(
    private _http: WpApiService
  ) { }

  ngOnInit() {
    this.projects$ = this._http.getRemoteData({path: 'projet', slug: 'per_page=12'}).pipe(
      map((res: any[]) => res.sort((a, b) => a.order_projet - b.order_projet))
    );
  }

  debug(projet) {
    console.log(projet);
  }
}
