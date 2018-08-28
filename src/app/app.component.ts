import { Component } from '@angular/core';

import { Platform } from '@ionic/angular';
import { SplashScreen } from '@ionic-native/splash-screen/ngx';
import { StatusBar } from '@ionic-native/status-bar/ngx';
import { Router } from '@angular/router';
import { tap } from 'rxjs/operators';

@Component({
  selector: 'app-root',
  templateUrl: 'app.component.html'
})
export class AppComponent {
  public disabled = true;
  public mobileNavigation: boolean;

  constructor(
    private platform: Platform,
    private splashScreen: SplashScreen,
    private statusBar: StatusBar,
    private _router: Router
  ) {
    this.initializeApp();
  }

  initializeApp() {
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
      this.mobileNavigation = !(this.platform.width() < 766);
      // console.log('this.mobileNavigation',
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
