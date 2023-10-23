namespace HijazCranes.Migrations
{
    using System;
    using System.Data.Entity.Migrations;
    
    public partial class AddingQuoteModel : DbMigration
    {
        public override void Up()
        {
            CreateTable(
                "dbo.Quotes",
                c => new
                    {
                        Id = c.Int(nullable: false, identity: true),
                        Customer_Id = c.Int(nullable: false),
                        Employee_Id = c.Int(nullable: false),
                        Discount = c.Single(),
                        Total = c.Double(nullable: false),
                        Created = c.DateTime(nullable: false),
                    })
                .PrimaryKey(t => t.Id)
                .ForeignKey("dbo.Customers", t => t.Customer_Id, cascadeDelete: true)
                .ForeignKey("dbo.Employees", t => t.Employee_Id, cascadeDelete: true)
                .Index(t => t.Customer_Id)
                .Index(t => t.Employee_Id);
            
        }
        
        public override void Down()
        {
            DropForeignKey("dbo.Quotes", "Employee_Id", "dbo.Employees");
            DropForeignKey("dbo.Quotes", "Customer_Id", "dbo.Customers");
            DropIndex("dbo.Quotes", new[] { "Employee_Id" });
            DropIndex("dbo.Quotes", new[] { "Customer_Id" });
            DropTable("dbo.Quotes");
        }
    }
}
