import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { CusrsusItemComponent } from '@app/features/cursus/containers/cusrsus-item/cusrsus-item.component';

const routes: Routes = [
  {
    path: '',
    children: [
      {
        path: ':slug',
        component: CusrsusItemComponent
      },
      {
        path: '',
        redirectTo: '',
        pathMatch: 'full',
      }
    ]
  },

];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class CursusRoutingModule { }
