import { NgModule, CUSTOM_ELEMENTS_SCHEMA, forwardRef, Injector } from '@angular/core';
import { IonicModule } from '@ionic/angular';
import { PipesModule } from '@app/shared/pipes';
import { WpApiService } from '@app/shared/services';
import { CommonModule } from '@angular/common';
import { MenuNavModule } from '@app/shared/menu-nav/menu-nav.module';
import { HeaderPeopleComponent } from '@app/shared/components/header-people/header-people.component';
import { AdressComponent } from '@app/shared/components/adress/adress.component';
import { ItemCardComponent } from '@app/shared/components/item-card/item-card.component';
import { SloganComponent } from '@app/shared/components/slogan/slogan.component';
import { FooterComponent } from '@app/shared/components/footer/footer.component';
import { HeaderAppComponent } from '@app/shared/components/header-app/header-app.component';
import { RouterModule } from '../../../node_modules/@angular/router';
// import { ReCaptchaDirective, RECAPTCHA_URL } from './directives/gcaptcha/gcaptcha';

const SHARED_COMPONENTS: any[] = [
  // add your shared component here
  HeaderPeopleComponent,
  AdressComponent,
  ItemCardComponent,
  SloganComponent,
  HeaderAppComponent,
  FooterComponent,
  // ReCaptchaDirective
];
const SHARED_SERVICES: any[] = [
  // add your shared services here
  WpApiService
];
const SHARED_IMPORT_MODULES: any[] = [
  // add your import available to export here
  MenuNavModule,
  CommonModule,
  PipesModule,
  IonicModule,
  RouterModule
];
const SHARED_EXPORT_MODULES: any[] = [
  // add your item available to export here
  ...SHARED_COMPONENTS,
  ...SHARED_IMPORT_MODULES,
];

@NgModule({
  imports: [
    ...SHARED_IMPORT_MODULES,
  ],
  providers: [
    ...SHARED_SERVICES
  ],
  declarations: [
    ...SHARED_COMPONENTS,
  ],
  exports: [
    ...SHARED_EXPORT_MODULES
  ],
  schemas: [CUSTOM_ELEMENTS_SCHEMA]
})
export class SharedModule { }
