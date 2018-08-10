import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { HeaderPeopleComponent } from './header-people.component';

describe('HeaderPeopleComponent', () => {
  let component: HeaderPeopleComponent;
  let fixture: ComponentFixture<HeaderPeopleComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ HeaderPeopleComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(HeaderPeopleComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
