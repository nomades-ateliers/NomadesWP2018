import { NgModule } from '@angular/core';


import { CategoryRoutingModule } from './category-routing.module';
import { CategoryComponent } from './containers/category/category.component';

import { SharedModule } from '@app/shared/shared.module';

@NgModule({
  imports: [
    SharedModule,
    CategoryRoutingModule
  ],
  declarations: [CategoryComponent]
})
export class CategoryModule { }
