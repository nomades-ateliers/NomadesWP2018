import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { PageComponent } from './containers/page/page.component';

const routes: Routes = [
  {
    path: '',
    children: [
      {
        path: '',
        component: PageComponent,
      },
      // {
      //   path: ':category',
      //   component: WorkshopCategoryComponent,
      // }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class PageRoutingModule { }
