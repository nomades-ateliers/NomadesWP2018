import { NgModule } from '@angular/core';

import { PostRoutingModule } from './post-routing.module';
import { PostComponent } from './containers/post/post.component';
import { SharedModule } from '@app/shared/shared.module';

@NgModule({
  imports: [
    PostRoutingModule,
    SharedModule
  ],
  declarations: [PostComponent],
  exports: []
})
export class PostModule { }
