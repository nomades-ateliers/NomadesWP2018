import { NgModule, CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';

import { AuthRoutingModule } from './auth-routing.module';
import { AuthPageComponent } from './containers/auth-page/auth-page.component';
import { SharedModule } from '@app/shared/shared.module';
import { ReactiveFormsModule } from '@angular/forms';
import { FileExplorerComponent } from '@app/features/auth/components/file-explorer/file-explorer.component';
import { FileService } from '@app/features/auth/services/file.service';

@NgModule({
  imports: [
    SharedModule,
    AuthRoutingModule,
    ReactiveFormsModule,
  ],
  declarations: [
    AuthPageComponent,
    FileExplorerComponent
  ],
  providers: [FileService],
  schemas: [CUSTOM_ELEMENTS_SCHEMA]
})
export class AuthModule { }
