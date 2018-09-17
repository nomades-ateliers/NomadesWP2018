import { NgModule } from '@angular/core';

import { RouterModule } from '@angular/router';
import { SharedModule } from '@app/shared/shared.module';
import { PageRoutingModule } from './page-routing.module';

import { PageComponent } from './containers/page/page.component';
import { ContactPageComponent } from './containers/contact-page/contact-page.component';
import { ReactiveFormsModule } from '@angular/forms';

@NgModule({
  imports: [
    SharedModule,
    ReactiveFormsModule,
    PageRoutingModule
  ],
  declarations: [
    PageComponent,
    ContactPageComponent,
  ],
  exports: [RouterModule]
})
export class PageModule { }
