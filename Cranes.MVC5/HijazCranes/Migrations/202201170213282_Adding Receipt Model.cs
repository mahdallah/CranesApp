namespace HijazCranes.Migrations
{
    using System;
    using System.Data.Entity.Migrations;
    
    public partial class AddingReceiptModel : DbMigration
    {
        public override void Up()
        {
            CreateTable(
                "dbo.Receipts",
                c => new
                    {
                        Id = c.Int(nullable: false, identity: true),
                        Paid = c.Double(nullable: false),
                        Remained = c.Double(nullable: false),
                        Quote_Id = c.Int(nullable: false),
                        Customer_Id = c.Int(nullable: false),
                        Account_Id = c.Int(nullable: false),
                        Created = c.DateTime(nullable: false),
                    })
                .PrimaryKey(t => t.Id)
                .ForeignKey("dbo.Accounts", t => t.Account_Id, cascadeDelete: true)
                .ForeignKey("dbo.Customers", t => t.Customer_Id, cascadeDelete: true)
                .ForeignKey("dbo.Quotes", t => t.Quote_Id, cascadeDelete: false)
                .Index(t => t.Quote_Id)
                .Index(t => t.Customer_Id)
                .Index(t => t.Account_Id);
            
        }
        
        public override void Down()
        {
            DropForeignKey("dbo.Receipts", "Quote_Id", "dbo.Quotes");
            DropForeignKey("dbo.Receipts", "Customer_Id", "dbo.Customers");
            DropForeignKey("dbo.Receipts", "Account_Id", "dbo.Accounts");
            DropIndex("dbo.Receipts", new[] { "Account_Id" });
            DropIndex("dbo.Receipts", new[] { "Customer_Id" });
            DropIndex("dbo.Receipts", new[] { "Quote_Id" });
            DropTable("dbo.Receipts");
        }
    }
}
