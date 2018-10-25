import { Component, OnInit, Input, ViewEncapsulation } from '@angular/core';

@Component({
  selector: 'app-header-people',
  templateUrl: './header-people.component.html',
  styleUrls: ['./header-people.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class HeaderPeopleComponent implements OnInit {

  @Input() readonly baseUrl: string;

  ngOnInit() {
    console.log('---> ', this.baseUrl);
  }

}
