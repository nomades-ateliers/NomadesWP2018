import { NgModule } from '@angular/core';
import { SafeHtmlPipe } from './safe-html/safe-html.pipe';
import { FilterByPipe } from './filter-by/filter-by.pipe';

@NgModule({
  imports: [
  ],
  declarations: [
    SafeHtmlPipe,
    FilterByPipe
  ],
  exports: [
    SafeHtmlPipe,
    FilterByPipe
  ]
})
export class PipesModule {}
