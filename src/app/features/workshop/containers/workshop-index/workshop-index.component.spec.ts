import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { WorkshopIndexComponent } from './workshop-index.component';

describe('WorkshopIndexComponent', () => {
  let component: WorkshopIndexComponent;
  let fixture: ComponentFixture<WorkshopIndexComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ WorkshopIndexComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(WorkshopIndexComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
