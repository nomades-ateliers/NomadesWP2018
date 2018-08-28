import { NgModule } from '@angular/core';

import { PageRoutingModule } from './page-routing.module';
import { PageComponent } from './containers/page/page.component';
import { RouterModule } from '@angular/router';
import { SharedModule } from '@app/shared/shared.module';
import { WorkshopsComponent } from './components/workshops/workshops.component';

@NgModule({
  imports: [
    SharedModule,
    PageRoutingModule
  ],
  declarations: [PageComponent, WorkshopsComponent],
  exports: [RouterModule]
})
export class PageModule { }
