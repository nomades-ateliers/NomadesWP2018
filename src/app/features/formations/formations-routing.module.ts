import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { FormationsComponent } from '@app/features/formations/containers/formations/formations.component';
import { FormationComponent } from '@app/features/formations/containers/formation/formation.component';

const routes: Routes = [{
  path: '',
  children: [
    {
        path: '',
        component: FormationsComponent,
    },
    {
      path: ':slug',
      component: FormationComponent
    }
  ]
}];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class FormationsRoutingModule { }
