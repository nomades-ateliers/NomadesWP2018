import { NgModule } from '@angular/core';

import { RouterModule } from '@angular/router';
import { SharedModule } from '@app/shared/shared.module';
import { PageRoutingModule } from './page-routing.module';

import { PageComponent } from './containers/page/page.component';

@NgModule({
  imports: [
    SharedModule,
    PageRoutingModule
  ],
  declarations: [
    PageComponent,
  ],
  exports: [RouterModule]
})
export class PageModule { }
