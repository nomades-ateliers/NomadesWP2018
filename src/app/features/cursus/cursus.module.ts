import { NgModule } from '@angular/core';

import { CursusRoutingModule } from './cursus-routing.module';
import { CusrsusItemComponent } from './containers/cusrsus-item/cusrsus-item.component';
import { SharedModule } from '@app/shared/shared.module';
import { ReactiveFormsModule } from '@angular/forms';

@NgModule({
  imports: [
    SharedModule,
    ReactiveFormsModule,
    CursusRoutingModule
  ],
  declarations: [CusrsusItemComponent]
})
export class CursusModule { }
