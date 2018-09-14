import { NgModule } from '@angular/core';

import { InscriptionRoutingModule } from './inscription-routing.module';
import { InscriptionComponent } from './containers/inscription/inscription.component';
import { SharedModule } from '@app/shared/shared.module';
import { ReactiveFormsModule } from '@angular/forms';

@NgModule({
  imports: [
    SharedModule,
    ReactiveFormsModule,
    InscriptionRoutingModule
  ],
  declarations: [InscriptionComponent]
})
export class InscriptionModule { }
