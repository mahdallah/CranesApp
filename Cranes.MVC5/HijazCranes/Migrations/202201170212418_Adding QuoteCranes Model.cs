namespace HijazCranes.Migrations
{
    using System;
    using System.Data.Entity.Migrations;
    
    public partial class AddingQuoteCranesModel : DbMigration
    {
        public override void Up()
        {
            CreateTable(
                "dbo.QuoteCranes",
                c => new
                    {
                        Id = c.Int(nullable: false, identity: true),
                        Crane_Id = c.Int(nullable: false),
                        Quote_Id = c.Int(nullable: false),
                        Price = c.Double(nullable: false),
                        HiredHours = c.Int(),
                        HiredItems = c.Int(),
                    })
                .PrimaryKey(t => t.Id)
                .ForeignKey("dbo.Cranes", t => t.Crane_Id, cascadeDelete: true)
                .ForeignKey("dbo.Quotes", t => t.Quote_Id, cascadeDelete: true)
                .Index(t => t.Crane_Id)
                .Index(t => t.Quote_Id);
            
        }
        
        public override void Down()
        {
            DropForeignKey("dbo.QuoteCranes", "Quote_Id", "dbo.Quotes");
            DropForeignKey("dbo.QuoteCranes", "Crane_Id", "dbo.Cranes");
            DropIndex("dbo.QuoteCranes", new[] { "Quote_Id" });
            DropIndex("dbo.QuoteCranes", new[] { "Crane_Id" });
            DropTable("dbo.QuoteCranes");
        }
    }
}
