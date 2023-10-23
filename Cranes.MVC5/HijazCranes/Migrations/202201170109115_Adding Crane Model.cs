namespace HijazCranes.Migrations
{
    using System;
    using System.Data.Entity.Migrations;
    
    public partial class AddingCraneModel : DbMigration
    {
        public override void Up()
        {
            CreateTable(
                "dbo.Cranes",
                c => new
                    {
                        Id = c.Int(nullable: false, identity: true),
                        Name = c.String(),
                        MaxWeightLiftInTon = c.Double(nullable: false),
                        PricePerHour = c.Double(nullable: false),
                        PricePerItem = c.Double(nullable: false),
                        Plate = c.String(),
                        Image = c.String(),
                        Created = c.DateTime(nullable: false),
                    })
                .PrimaryKey(t => t.Id);
            
        }
        
        public override void Down()
        {
            DropTable("dbo.Cranes");
        }
    }
}
