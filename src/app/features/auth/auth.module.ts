import { NgModule, CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';

import { AuthRoutingModule } from './auth-routing.module';
import { AuthPageComponent } from './containers/auth-page/auth-page.component';
import { SharedModule } from '@app/shared/shared.module';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { FileExplorerComponent } from './components/file-explorer/file-explorer.component';
import { FileService } from './services/file.service';
import { NewFolderDialogComponent } from './components/new-folder-dialog/new-folder-dialog.component';

@NgModule({
  imports: [
    FormsModule,
    SharedModule,
    AuthRoutingModule,
    ReactiveFormsModule,
  ],
  declarations: [
    AuthPageComponent,
    FileExplorerComponent,
    NewFolderDialogComponent
  ],
  providers: [FileService],
  entryComponents: [NewFolderDialogComponent],
  schemas: [CUSTOM_ELEMENTS_SCHEMA],
})
export class AuthModule { }
