import { Injectable, Injector } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Router } from '@angular/router';
import { environment } from '../environments/environment';
import { map } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class AppConfigService {

  private _routerConfig: any = null;
  private _promise: Promise<any>;
  private _promiseDone = false;

  private config: any = null;
  private readonly _wpBase = environment.wpBase;

  _router: Router;

  constructor(
    public injector: Injector,
    private _http: HttpClient,
  ) { }

  /**
  * Use to get the data config
  */
  public getConfig() {
    return this.config;
  }

  /**
  * Load httpRequest from wp api "/config" endpoint to get all env's variables
  * (e.g.: 'config.menu', 'config.site_title', config.site_description)
  */
  public load() {
    console.log('load data...');
    return this._http.get(this._wpBase + 'config')
    .toPromise()
    .then((data: any) => this.config = data)
    .then((data: any) => this.config.entryPath = 'wordpress')
    .then(_ => this.loadRoutes())
    .then(res => {
      // console.log(this.getConfig());
      if (!res) {
        return;
      }
      this._router = this.injector.get(Router);
      const routerDefaultRoutes = this._router.config;
      this.getConfig().pages
      .filter((item: any) => !routerDefaultRoutes.map(r => r.path).includes(item.slug))
      .map(
        item => ({ path: item.slug, loadChildren:
          (item.object || null)
            ? `./features/${item.object}/${item.object}.module#${item.object[0]
                                                                .toUpperCase()}${item.object
                                                                .slice(1)
                                                                .toLowerCase()}Module`
            : './features/page/page.module#PageModule'
          })
      )
      .map(item => {
        this._router.config.unshift(item);
        return item;
      });
      // if (!environment.production) {
        console.log('Finale routes---->', [...routerDefaultRoutes]);
      // }
      return this._router.resetConfig([...routerDefaultRoutes]);
    })
    .catch((err: any) => Promise.reject(err));
  }

  loadRoutes(forceReload: boolean = false): Promise<any> {
    if (this._promiseDone) {
        console.log('In Config Service. Promise is already complete.');
        return Promise.resolve();
    }

    if (this._promise != null) {
        console.log('In Config Service. Promise exists.  Returning it.');
        return this._promise;
    }
    console.log('In Config Service. Loading config data.');
    this._promise = this._http
        .get(this._wpBase + 'pages')
        .pipe(map((res: Response) => res))
        .toPromise()
        .then(async (data: any) => {
          this.config.pages = data;
          this._promiseDone = true;
          return await this.config;
        })
        .catch((err: any) => { this._promiseDone = true; return Promise.resolve(); });
    return this._promise;
  }

  get routerConfig(): any {
      return this._routerConfig;
  }
}
