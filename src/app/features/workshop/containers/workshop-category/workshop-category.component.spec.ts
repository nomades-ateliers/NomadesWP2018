import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { WorkshopCategoryComponent } from './workshop-category.component';

describe('WorkshopCategoryComponent', () => {
  let component: WorkshopCategoryComponent;
  let fixture: ComponentFixture<WorkshopCategoryComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ WorkshopCategoryComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(WorkshopCategoryComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
