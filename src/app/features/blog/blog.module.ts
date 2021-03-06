import { NgModule } from '@angular/core';

import { BlogRoutingModule } from './blog-routing.module';
import { HomeComponent } from './containers/home/home.component';
import { RouterModule } from '@angular/router';
import { SharedModule } from '@app/shared/shared.module';

@NgModule({
  imports: [
    BlogRoutingModule,
    SharedModule
  ],
  declarations: [HomeComponent],
  exports: [RouterModule]
})
export class BlogModule { }
