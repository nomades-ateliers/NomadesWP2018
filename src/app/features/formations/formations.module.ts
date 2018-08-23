import { NgModule } from '@angular/core';

import { FormationsRoutingModule } from './formations-routing.module';
import { FormationComponent } from './containers/formation/formation.component';
import { FormationsComponent } from './containers/formations/formations.component';
import { SharedModule } from '@app/shared/shared.module';

@NgModule({
  imports: [
    SharedModule,
    FormationsRoutingModule
  ],
  declarations: [
    FormationComponent,
    FormationsComponent
  ]
})
export class FormationsModule { }
