import { Component, Inject, ViewEncapsulation } from '@angular/core';

import { Platform , MenuController} from '@ionic/angular';
import { SplashScreen } from '@ionic-native/splash-screen/ngx';
import { StatusBar } from '@ionic-native/status-bar/ngx';
import { Router, ActivatedRoute } from '@angular/router';
import { tap } from 'rxjs/operators';
import { AppConfig } from '@app/app-config.token';

@Component({
  selector: 'app-root',
  templateUrl: 'app.component.html',
  encapsulation: ViewEncapsulation.None
})
export class AppComponent {
  public disabled = true;
  public mobileNavigation: boolean;
  public menuItems: any[];
  public ionConfig: any;
  public currentUrl = '/';

  constructor(
    @Inject(AppConfig) public readonly config: any,
    private platform: Platform,
    private splashScreen: SplashScreen,
    private statusBar: StatusBar,
    public _router: Router,
    public menuCtl: MenuController
  ) {
    this.initializeApp();
  }

  initializeApp() {
    this.ionConfig = {
      mode: 'md'
    };
    this._router.events.subscribe(
      (res: any) => (res.state) ? this.currentUrl = res.state.url : null,
      err => console.log('err', err)
    );

    return this.platform.ready().then(() => {
      console.log(this.platform.platforms());
      if (this.platform.is('android')) {
        console.log('running on Android device!');
      }
      if (this.platform.is('ios')) {
          console.log('running on iOS device!');
      }
      if (this.platform.is('mobileweb')) {
          console.log('running in a browser on mobile!');
      }
      this.statusBar.styleDefault();
      this.splashScreen.hide();
      this.menuItems = this.config.menu;
      this.mobileNavigation = !(this.platform.width() < 766);
      console.log('this.mobileNavigation', this.mobileNavigation);
      //   this.mobileNavigation,
      // );
      // this.platform.resize.subscribe(
      //   data => console.log('resize', data)
      // );
      // this.platform.resize
      // .subscribe(
      //   data => console.log('resize', data)
      // );
      // this.platform.
      // console.log('Configured routes: ', this._router.config);
    });
  }

}
