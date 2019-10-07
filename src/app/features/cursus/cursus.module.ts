import { NgModule, CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';

import { CursusRoutingModule } from './cursus-routing.module';
import { CusrsusItemComponent } from './containers/cusrsus-item/cusrsus-item.component';
import { SharedModule } from '@app/shared/shared.module';
import { ReactiveFormsModule } from '@angular/forms';
// import { RecaptchaModule } from 'ng-recaptcha';

@NgModule({
  imports: [
    SharedModule,
    ReactiveFormsModule,
    CursusRoutingModule,
    // RecaptchaModule
  ],
  declarations: [CusrsusItemComponent],
  schemas: [CUSTOM_ELEMENTS_SCHEMA]
})
export class CursusModule { }
