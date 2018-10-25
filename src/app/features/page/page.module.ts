import { NgModule, NO_ERRORS_SCHEMA } from '@angular/core';

import { RouterModule } from '@angular/router';
import { SharedModule } from '@app/shared/shared.module';
import { PageRoutingModule } from './page-routing.module';

import { PageComponent } from './containers/page/page.component';
import { ContactPageComponent } from './containers/contact-page/contact-page.component';
import { ReactiveFormsModule } from '@angular/forms';
import { ProjectsPageComponent } from './containers/projects-page/projects-page.component';


@NgModule({
  imports: [
    SharedModule,
    ReactiveFormsModule,
    PageRoutingModule
  ],
  declarations: [
    PageComponent,
    ContactPageComponent,
    ProjectsPageComponent,
  ],
  exports: [RouterModule],
  schemas: [NO_ERRORS_SCHEMA]
})
export class PageModule { }
