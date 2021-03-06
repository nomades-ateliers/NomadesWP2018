import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { WorkshopCategoryComponent } from './containers/workshop-category/workshop-category.component';
import { WorkshopIndexComponent } from '@app/features/workshop/containers/workshop-index/workshop-index.component';
import { WorkshopItemComponent } from '@app/features/workshop/containers/workshop-item/workshop-item.component';

const routes: Routes = [
    {
      path: '',
      children: [
        {
          path: '',
          component: WorkshopIndexComponent,
        },
        {
          path: ':category',
          children: [
            {
              path: '',
              component: WorkshopCategoryComponent,
            },
            {
              path: ':sub',
              children: [
                // {
                //   path: '',
                //   redirectTo: './workshops',
                // },
                {
                  path: ':name',
                  component: WorkshopItemComponent,
                }
              ]
            },
          ]
        },
      ],
    }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class WorkshopRoutingModule { }
