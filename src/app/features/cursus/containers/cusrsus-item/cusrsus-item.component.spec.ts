import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CusrsusItemComponent } from './cusrsus-item.component';

describe('CusrsusItemComponent', () => {
  let component: CusrsusItemComponent;
  let fixture: ComponentFixture<CusrsusItemComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CusrsusItemComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CusrsusItemComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
