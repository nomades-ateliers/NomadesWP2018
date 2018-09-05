import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { WorkshopRoutingModule } from './workshop-routing.module';
import { WorkshopCategoryComponent } from './containers/workshop-category/workshop-category.component';
import { WorkshopsComponent } from './components/workshops/workshops.component';
import { SharedModule } from '@app/shared/shared.module';
import { RouterModule } from '@angular/router';
import { WorkshopIndexComponent } from './containers/workshop-index/workshop-index.component';
import { WorkshopItemComponent } from './containers/workshop-item/workshop-item.component';

@NgModule({
  imports: [
    SharedModule,
    WorkshopRoutingModule
  ],
  declarations: [
    WorkshopCategoryComponent,
    WorkshopIndexComponent,
    WorkshopItemComponent,
    WorkshopsComponent,
  ],
  exports: [RouterModule]
})
export class WorkshopModule { }
