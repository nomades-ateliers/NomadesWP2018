import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'filterBy'
})
export class FilterByPipe implements PipeTransform {

  transform(wks: any[], args: {prop: string, value: string|number}): any {
    // prevent unexisting item
    if (!wks) {
      return null;
    }
    return wks.filter(wk => (wk[args.prop][0]) === args.value);

  }

}
