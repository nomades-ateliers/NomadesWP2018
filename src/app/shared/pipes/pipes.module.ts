import { NgModule } from '@angular/core';
import { SafeHtmlPipe } from './safe-html/safe-html.pipe';
import { FilterByPipe } from './filter-by/filter-by.pipe';
import { ReplaceByPipe } from './replace-by/replace-by.pipe';

const PIPES = [
  SafeHtmlPipe,
  FilterByPipe,
  ReplaceByPipe
];
@NgModule({
  imports: [
  ],
  declarations: [
    ...PIPES
  ],
  exports: [
    ...PIPES
  ]
})
export class PipesModule {}
