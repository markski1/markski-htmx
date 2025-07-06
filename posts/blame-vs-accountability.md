Who's to blame and when does it matter
July 6, 2025
Up to what point is someone else's fault not your fault?

---

### Origin

After a recent outage of Google Cloud Services, and the domino effect it brought along, [a post on X by Dane Knetch](https://x.com/dok2001/status/1933272215396688124/), the CTO of Cloudflare, regarding the effects of the outage on their platform, acknoweldges the following:

> At the end of the day we are responsible for our availability.

### Dilemma

A vendor can be the cause of an outage. It is not a reasonable expectation for a company to have complete physical access and control of their infra, if any at all, especially at Startup level.

It is not the decision of a company's costumers for any infrastructure to be dependant on a specific cloud. However it is also not their engineers' fault that a given cloud would fail to maintain service.

### Nobody ever got fired for buying IBM

A well known, old-school phrase to signify cynicism around a fact: The safe expensive choice is what one is borderline forced to lean into, if they wish to keep their neck untouched above all else when it comes to business purchase decisions. 

Nowadays, this is probably either Amazon, Google or Microsoft. None of the above can assure truly perfect service availability, however. Not even due to incompetence, there's a million variables that can make things stop working and not one single entity is in control of them all.

### Mitigations

Working from the bottom up, there's a bit of a logical order of things to follow, a little more extreme and less reasonable as you work your way up.

***Multiple instances***: While I am violently opposed to the general microservices and "serverless" trend and terminology, the foundation of them is good. Your applications should ideally be able to "live" in multiple places at once, load balanced. Or, at the very least, have some sort of watchdog, capable of detecting failures or downtime and "respawn" them elsewhere.

***Multiple regions***: When a cloud provider fails, it's usually at "availability zone" level. Different providers use different names for this, but basically when located within a region you should have your services spread across separate AZ's. It is not unheard of, however, for an entire region to outright fail. Not to mention the potential for regional catastrophes, acts of god or infrastructural failure (ie. prolonged loss of power) to happen.

It is not unreasonable then, that you should be able to serve from different places in the world. There is a joke that if Amazon's "us-east-1" were to disappear, so would a significant chunk of the economy. This is funny. However, if this is true for your organization, perhaps try and plan around it.

To do this "properly" by actively serving off separate regions in an efficient manner can be hard. I could go into a whole tangent about the awfully-often-ignored consecuences of separating data from compute, but I'll just limit myself to saying that you should at the very least be able to failover to other regions without requiring all hands on deck.

***Multiple providers***: Quite self explanatory, and also quite extreme. To failover or actively serve off separate providers is probably the ultimate show of resilience, and perhaps the closest to 100% uptime you can go short short of your own services' shortcomings.

Though the practical problems from this are cruel: Inter-cloud networking will usually not be as fast as within a region or cloud. To set up private tunnels between them can be a bit of a devops nightmare, not to mention setting up VPNs like Twingate and the cost of managing all of that... And let's not even touch the touchy subject of cost of inter-cloud bandwidth!

The multiple providers rule can be applied a bit wider than just compute providers: If you use a third party service of transactional mails, what happens if the one you use fails? Would it be reasonable to have two such providers and an internal failover layer for mailing? How about payment gateways? Auth providers? (Though I strongly believe that if you don't roll your own auth you kinda deserve everything that comes with such laziness...)

Either way...

### Redundancy

The name of the game is *the magic of having two of them*. Or more. The entire point around this post is that to rely on a single vendor for anything means that you limit yourself to the competence of the vendor.

When problems arise once or twice a blue moon it can be acceptable to blame the vendor. They should uphold their SLA after all. But your customers will not care, especially when a issue becomes recurrent.

You chose the vendor. You should hold yourself accountable if you're not doing enough to work around their shit.