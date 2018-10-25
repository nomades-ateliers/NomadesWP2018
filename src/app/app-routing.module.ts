import { NgModule, APP_INITIALIZER, Injector } from '@angular/core';
import { Routes, RouterModule, Router } from '@angular/router';
import { AppConfigService } from '@app/app-config.service';

const routes: Routes = [
  { path: '', redirectTo: 'index', pathMatch: 'full' },
  { path: 'index', loadChildren: './features/front-page/front-page.module#FrontPageModule'},
  { path: 'formations', loadChildren: './features/formations/formations.module#FormationsModule'},
  { path: 'workshops', loadChildren: './features/workshop/workshop.module#WorkshopModule'},
  { path: 'cursus', loadChildren: './features/cursus/cursus.module#CursusModule'},
  { path: 'blog', loadChildren: './features/blog/blog.module#BlogModule'},
  { path: 'page', loadChildren: './features/page/page.module#PageModule'},
  { path: 'inscription', loadChildren: './features/inscription/inscription.module#InscriptionModule'},
  { path: 'auth', loadChildren: './features/auth/auth.module#AuthModule'},
  { path: '404', loadChildren: './features/not-found/not-found.module#NotFoundModule'},
  { path: '**', redirectTo: '404', pathMatch: 'full' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule],
})
export class AppRoutingModule { }

