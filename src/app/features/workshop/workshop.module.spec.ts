import { WorkshopModule } from './workshop.module';

describe('WorkshopModule', () => {
  let workshopModule: WorkshopModule;

  beforeEach(() => {
    workshopModule = new WorkshopModule();
  });

  it('should create an instance', () => {
    expect(workshopModule).toBeTruthy();
  });
});
